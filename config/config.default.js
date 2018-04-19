const configDefault = {
        'plainPrefix': 'wpps',
        get prefix() {
            return `${this.plainPrefix}_`
        },
        'pluginName': 'Skeleton',
        'pluginFile': 'wp-skeleton-plugin.php'
    };

module.exports = configDefault;