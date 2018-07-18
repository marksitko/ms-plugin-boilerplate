var defaultConfig = require('./config.default');
/* start-dev-block */
var buildConfig = require('./config.build');
/* end-dev-block */
var directoriesConfig = require('./config.directories');
var settingsConfig = require('./config.settings');

const config = {
    'default': {
        ...defaultConfig
    },
    /* start-dev-block */
    'build': {
        ...buildConfig
    },
    /* end-dev-block */
    'directories': {
        ...directoriesConfig
    },
    'settings': {
        ...settingsConfig
    }
};

module.exports = config;