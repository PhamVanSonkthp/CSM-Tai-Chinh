const entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
}

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    })
    //ENCODED FOR MAXIMUM SAFETY
}

function formatCommentTime(value) {
    const date = new Date(value).getTime();

    const a = new Date().getTime() - date;
    if (a < 60000) {
        return `${Math.floor(a / 1000)} giây trước`;
    } else if (a < 3600000) {
        return ` ${Math.floor(a / 60000)} phút trước`;
    } else if (a >= 3600000 && a < 86400000) {
        return ` ${Math.floor(a / 3600000)} giờ trước`;
    } else if (a >= 86400000 && a < 2592000000) {
        return ` ${Math.floor(a / 86400000)} ngày trước`;
    } else if (a >= 2592000000 && a < 31104000000) {
        return ` ${Math.floor(a / 2592000000)} tháng trước`;
    } else {
        return ` ${Math.floor(a / 31104000000)} năm trước`;
    }
}
