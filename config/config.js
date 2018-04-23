var defaultConfig = require('./config.default');
var buildConfig = require('./config.build');
var directoriesConfig = require('./config.directories');
var settingsConfig = require('./config.settings');

const config = {
    'default': {
        ...defaultConfig
    },
    'build': {
        ...buildConfig
    },
    'directories': {
        ...directoriesConfig
    },
    'settings': {
        ...settingsConfig
    }
};

module.exports = config;