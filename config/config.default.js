const configDefault = {
        'plainPrefix': 'mspb',
        get prefix() {
            return `${this.plainPrefix}_`
        },
        'pluginName': 'MSPluginBoilerplate',
        'bootstrapFile': 'ms-plugin-boilerplate.php',
        'devUrl': 'http://localhost',
    };

module.exports = configDefault;