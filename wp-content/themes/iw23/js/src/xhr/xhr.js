/**
 * Open XHR
 */
const openXHR = (url) => {
  const xhr = new XMLHttpRequest();

  xhr.open("POST", url);

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  return xhr;
};

/**
 * Send XHR
 *
 * @param {XMLHttpRequest} xhr
 * @param {string} action
 * @param {string} payload
 */
const sendXHR = (xhr, action, payload) => {
  xhr.send(`action=${action}&payload=${encodeURIComponent(payload)}`);
};

/**
 * Do Ajax
 *
 * @param {string} url
 * @param {string} action
 * @param {string} payload
 * @param {function} onStart
 * @param {function} onError
 * @param {function} onSuccess
 */
const ajaxRequest = (
  url,
  action,
  payload,
  onStart = () => {},
  onError = () => {},
  onSuccess = () => {}
) => {
  const xhr = openXHR(url);

  xhr.onreadystatechange = () => {
    // Handle readyState error
    if (xhr.readyState !== 4) {
      return;
    }

    // Handle status error
    if (xhr.status !== 200) {
      console.log(xhr);

      onError({ data: { message: xhr.responseText } });
      return;
    }

    const response = JSON.parse(xhr.responseText);

    // Handle response error
    if (!response.success) {
      onError(response);
      return;
    }

    // Handle complete
    onSuccess(response);

    return response;
  };

  sendXHR(xhr, action, payload);

  onStart();
};

module.exports = ajaxRequest;
