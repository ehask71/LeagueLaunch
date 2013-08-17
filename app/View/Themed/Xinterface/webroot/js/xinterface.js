// use a strict regular expression for security
var query = /key=([a-z|A-Z]*)(&value=([a-z|A-Z]*))?/.exec(location.search),
    key   = query[1],
    value = escape(query[3]);
    alert(query);
// check if the url is valid
if (query && key) {
    // call the public function
    if (key === 'log') {
        alert(value);
        window.parent.closeDialog(value);
    }
}