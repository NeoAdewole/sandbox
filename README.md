# Fit Fresh Theme

## Introduction

Sandbox is a block theme that comes bundled with the [Clearblocks](https://github.com/9janeo/clearblocks) plugin. It uses [Bootstrap](http://getbootstrap.com/) for css styling.

## Development
- npm install

### Browser Sync
Browser Sync is installed as a dev dependency. To setup
- Create a browser-sync.config.js in your project <br>
- Example:
    `module.exports = {
    	"proxy": "myproject.dev",
    	"notify": false,
    	"files": ["./css/*.min.css", "./js/*.min.js", "./**/*.php"]
    };`