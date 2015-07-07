# Summary

A journaling proxy to the Facebook's [WebDriver](https://github.com/facebook/php-webdriver). Wraps a
`WebDriver` instance, and complements the original method calls with taking screen-shots, and
capturing the browser log messages. As the result, a _journal_ of the executed browser session is
created: a [Markdown](http://daringfireball.net/projects/markdown/) document with embedded
screen-shots, DOM query records, console messages, etc.
