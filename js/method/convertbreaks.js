function convertLineBreaks(htmlString) {
    return htmlString.replace(/<br\s*\/?>/gi, '\n');
}

function convertHtmlBreaks(string) {
    return string.replace(/\n/g, '<br/>');
}
export { convertLineBreaks, convertHtmlBreaks };