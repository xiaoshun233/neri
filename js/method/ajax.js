/**
 * 
 * @param {String} url 
 * @param {String|object} data 
 * @param {String} request 
 * @return {array[object]|undefined}
 */

//ajax与后端php进行数据交互
function loadXMLDoc(url = "", data = void 0, request = "post") {
	const xhr = new XMLHttpRequest();
	let result
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			result = JSON.parse(xhr.responseText);
		}
	}
	xhr.open(request, `${url}`, false);
	const StrData = JSON.stringify(data);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(`data=${StrData}`);
	return result;
}

export { loadXMLDoc }