const build = {
    'plainPrefix': 'mp',
    get prefix() {
        return `${this.plainPrefix}_`
    },
    'pluginName': 'myPlugin',
    get dest() {
        return `./${this.pluginName}/`
    },
};

module.exports = build;