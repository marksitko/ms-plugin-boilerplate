const configDefault = {
        'plainPrefix': 'mspb',
        get prefix() {
            return `${this.plainPrefix}_`
        },
        'pluginName': 'MSPluginBoilerplate',
        'bootstrapFile': 'ms-plugin-boilerplate.php'
    };

module.exports = configDefault;