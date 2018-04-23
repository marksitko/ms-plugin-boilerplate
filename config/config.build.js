const build = {
    'plainPrefix': 'ka',
    get prefix() {
        return `${this.plainPrefix}_`
    },
    'pluginName': 'kennzahlenAdmin',
    get dest() {
        return `./${this.pluginName}/`
    },
};

module.exports = build;