const directories = {
    'sass': 'assets/src/scss/',
    'css': 'assets/dist/css/',
    'jsSrc': 'assets/src/js/',
    get ajaxSrc() {
        return `${this.jsSrc}ajax/`
    },
    get jsPublicSrc() {
        return `${this.jsSrc}public/`
    },
    get jsBackendSrc() {
        return `${this.jsSrc}backend/`
    },
    get jsSharedSrc() {
        return `${this.jsSrc}shared/`
    },
    'js': 'assets/dist/js/',
};

module.exports = directories;