export default (Alpine) => {
    const userSearch = (text, cb) => {
        axios.get("/users/search?q=" + text).then((response) => {
            cb(response.data)
        })
    }

    Alpine.directive('mentionable', (el) => {
        let tribute = new Tribute({
            trigger: "@",
            values: (text, cb) => userSearch(text, users => cb(users)),
            lookup: "value",
            fillAttr: "value",
            menuItemTemplate: (item) => {
                return "@" + item.original.value + " (" + item.original.key + ")"
            }
        })

        tribute.attach(el)
    })
}
