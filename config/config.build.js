// write your pluginName in camelCase style
const build = {
    'plainPrefix': 'pn',
    get prefix() {
        return `${this.plainPrefix}_`
    },
    'pluginName': 'pluginName',
    get dest() {
        return `./${this.pluginName}/`
    },
};

module.exports = build;