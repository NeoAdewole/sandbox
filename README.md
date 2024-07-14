# Sandbox Theme
![Sandbox](assets/public/sandbox.png)

## Introduction

Sandbox is a block theme that comes bundled with the [Clearblocks](https://github.com/9janeo/clearblocks) plugin. It uses [Bootstrap](http://getbootstrap.com/) for css styling.

## Feature Roadmap
- Built-in Slider and Slide blocks
- Default OpenGraph Options

## Development
### npm install
### Browser Sync
Browser Sync is installed as a dev dependency. To setup
- Create a browser-sync.config.js in your project <br>
- Example:
    `module.exports = {
    	"proxy": "myproject.dev",
    	"notify": false,
    	"files": ["./css/*.min.css", "./js/*.min.js", "./**/*.php"]
    };`
### Wp Scripts
- `npm run build` (build blocks)
- `npm run start` (block development)
