# Summary

A journaling proxy to the Facebook's [WebDriver](https://github.com/facebook/php-webdriver). Wraps a
`WebDriver` instance, and complements the original method calls with taking screen-shots, and
capturing the browser log messages. As the result, a _journal_ of the executed browser session is
created: an HTML document with embedded screen-shots, DOM query records, console messages, etc.

# Why?

We have an automatic headless screen-scraping tool implemented with
[Selenium](http://docs.seleniumhq.org/) + [PhantomJS](http://phantomjs.org/) (no idea why PhantomJS
by itself wasn't enough). Sometimes it screws up: ticket order fails, wrong kind of tickets gets
selected, or a child name gets confused with an adult name. This tool is summoned to ease the
debugging of such failures.

# Status

**Work in progress**
