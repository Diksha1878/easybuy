function searchFilter(key, value = null, noReload) {
    //debugger;
    var loc = window.location;
    //  //console.log(loc);
    pkeyObj_ = {};
    var keystring = "";
    var url = loc.origin + loc.pathname + "?";
    if (loc.search !== "") {
        // //console.log(loc.search.replace('?', ''));
        var q = loc.search.replace("?", "");
        var q_array = q.split("&");
        //console.log(q_array);

        var pkey = [];
        var pkeyObj = {};
        var comma = "";
        for (i = 0; i < q_array.length; i++) {
            if (i != 0) {
                comma = ",";
            }
            var skey = key + "=" + value;

            var p_key = q_array[i].split("=");
            p_key.pop();
            var p_value = q_array[i].split("=").pop();
            pkeyObj[p_key[0]] = p_value;

            //pkey.push(pkeyObj);
            // pkey.push({p_key[0]:p_value});

            ////console.log(p_key[0]);
        }

        delete pkeyObj[key];
        var objCheckEmpty = $.map(pkeyObj, function (el) {
            return el;
        });
        //  var objCheckEmpty =  $.isEmptyObject(pkeyObj);
        // //console.log(pkeyObj);
        // //console.log(objCheckEmpty.length);

        //  //console.log(pkeyObj);
        if (objCheckEmpty.length) {
            //pkey = $.unique(pkey);
            pkeyObj = JSON.stringify(pkeyObj);
            pkeyObj = pkeyObj.replace("}", "");
            pkeyObj = pkeyObj.replace("{", "");
            var count = (pkeyObj.match(/"/g) || []).length;
            for (i = 0; i < count; i++) {
                pkeyObj = pkeyObj.replace('"', "");
            }

            pkeyObj = pkeyObj.split(",");

            var sap = "?";

            for (i = 0; i < pkeyObj.length; i++) {
                if (i != 0) {
                    sap = "&";
                }
                var s = pkeyObj[i];
                var r = s.split(":");
                //   //console.log(r);
                if (r.length != 0) {
                    keystring += sap + r[0] + "=" + r[1];
                }
            }
            keystring = keystring + "&";
        } else {
            keystring = "?";
        }
        // //console.log(keystring);
        url = loc.origin + loc.pathname + keystring;
        //  //console.log(url);
    }

    var targetTitle = "Search Result";
    if (value !== "") {
        // //console.log(url + key + '=' + value);
        var targetUrl = url + key + "=" + value;
        window.history.pushState(
            { url: "" + targetUrl + "" },
            targetTitle,
            targetUrl
        );

        //window.location=url+key+'='+value;
    } else {
        if (keystring.length) {
            var keystring = keystring.substring(0, keystring.length - 1);
            var targetUrl = loc.origin + loc.pathname + keystring;
            window.history.pushState(
                { url: "" + targetUrl + "" },
                targetTitle,
                targetUrl
            );
        }
        // window.location=loc.origin + loc.pathname+keystring;
    }

    if (noReload && typeof noReload == "function") {
        function getParams_(key) {
            var loc = window.location;
            var pkeyObj = {};
            if (loc.search !== "") {
                // //console.log(loc.search.replace('?', ''));
                var q = loc.search.replace("?", "");
                var q_array = q.split("&");
                //console.log(q_array);

                var pkey = [];

                var comma = "";
                for (i = 0; i < q_array.length; i++) {
                    if (i != 0) {
                        comma = ",";
                    }
                    //var skey = key + "=" + value;
                    var p_key = q_array[i].split("=");
                    p_key.pop();
                    var p_value = q_array[i].split("=").pop();
                    pkeyObj[p_key[0]] = p_value;
                }
            }
            return pkeyObj;
        }
        noReload(getParams_());
    } else if (noReload == null || noReload == false) {
        window.location.reload();
    }
}
function getParams(key) {
    var loc = window.location;
    var pkeyObj = {};
    if (loc.search !== "") {
        // //console.log(loc.search.replace('?', ''));
        var q = loc.search.replace("?", "");
        var q_array = q.split("&");
        //console.log(q_array);

        var pkey = [];

        var comma = "";
        for (i = 0; i < q_array.length; i++) {
            if (i != 0) {
                comma = ",";
            }
            //var skey = key + "=" + value;
            var p_key = q_array[i].split("=");
            p_key.pop();
            var p_value = q_array[i].split("=").pop();
            pkeyObj[p_key[0]] = p_value;
        }
    }

    if (key) {
        return pkeyObj[key];
    } else {
        return pkeyObj;
    }
}
