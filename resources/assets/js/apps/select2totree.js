const appName = 'vue-subjectsToTree'

if (jQuery('#' + appName).length > 0) {
  const app = new Vue({
    el: '#vue-subjectsToTree',
    data: {
      subjectsTree: [],
      subjectsArray: [],
      refreshing: true,
      fullSubjectName: null,
    },

    computed: {
      selectedId: {
        get() {
          console.info(document.getElementById('value-input').value)
          return document.getElementById('value-input').value
        },

        set(payload) {
          input = document.getElementById('value-input')
          input.value = payload
        },
      },

      selectedLabel: {
        get() {
          const e = document.getElementById('label-input')
          console.info(e.value)
          return this.fullSubjectName
            ? this.fullSubjectName
            : e.value
            ? e.value
            : 'Root'
        },

        set(payload) {
          input = document.getElementById('label-input')
          input.value = payload
          this.fullSubjectName = payload
        },
      },
    },

    methods: {
      refresh() {
        axios
          .get('/assuntos/json/array', {
            params: {},
          })
          .then(response => {
            this.subjectsArray = response.data
          })
          .catch(error => {
            console.log(error)
            this.subjectsArray = []
          })

        axios
          .get(
            '/assuntos/json/tree' +
              (this.selectedId ? '/' + this.selectedId : ''),
            {
              params: {},
            },
          )
          .then(response => {
            this.subjectsTree = response.data

            console.log(this.subjectsTree)

            $('#subjectsTreeSelect').select2ToTree({
              treeData: { dataArr: this.subjectsTree },
              maximumSelectionLength: 3,
            })

            $('#subjectsTreeSelect').on('change', () => {
              e = document.getElementById('subjectsTreeSelect')
              id = e.options[e.selectedIndex].value
              this.selectedLabel = this.subjectsArray[id].full_name

              this.selectedId = e.options[e.selectedIndex].value
            })
          })
          .catch(error => {
            console.log(error)

            this.subjectsTree = []
          })

        this.refreshing = false
      },
    },
    beforeMount() {
      this.refresh()
    },
  })
}
