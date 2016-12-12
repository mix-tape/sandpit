# Hibiki - Birdbrain's Wordpress starter theme

> Wordpress Theme Development Kit

A framework for rapid Wordpress development using the Bower front end package manager and Gulp build tool

## Breakdown

By default, on install this theme will -

- set a few friendly defaults
- remove a whole lot of default cruft
- change the default behaviour of several Wordpress features

The framework is fairly opinionated, it will often have an example of how best to approach a problem.

## Dependencies

- Nodejs/npm (`brew install node`)
- Gulp + Bower (`npm install -g gulp bower`)
- Optional Yarn as a replacement to npm (`npm install -g yarn`)

## Getting Started

Make sure you have all your dependencies installed

Clone or checkout this repo into your themes directory and run `npm install && bower install` to install all the dependencies

## Build Process

You can run the default (`watch` based) task with `gulp`. This task will add debug information to SASS for testing + leave all coded expanded.

For production use `gulp build` which will minify, strip comments and uglify all code to decrease server requests.

## Tasks

### `browser-sync`

### `lint-styles`

### `styles`

### `compress-styles`

### `scripts`

### `compress-scripts`

## Todo
