/* 代码整理：懒人之家 www.lanrenzhijia.com */
var config = module.exports;

config["jQuery Collapse specs"] = {
  rootPath: "",
  environment: "browser",
  sources: [
    "js/jquery-1.8.1.js",
    "js/json2.js",
    "js/jquery.collapse.js",
    "js/jquery.collapse_storage.js",
    "js/jquery.collapse_cookie_storage.js"
  ],
  tests: [
    "js/*_spec.js"
  ],
  extensions: [require("buster-html-doc")]
}
/* 代码整理：懒人之家 www.lanrenzhijia.com */