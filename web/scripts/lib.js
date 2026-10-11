function isAlpha(code)
{
    return (code > 64 && code < 91) || (code > 96 && code < 123)
}
function isAlphaOrSpace(code)
{
    return isAlpha(code) || code === " ".charCodeAt(0)
}

function isAlphaNumericOrSpace(str)
{
    var code, i;

    for (i = 1; i < str.length; i++)
    {
        code = str.charCodeAt(i);
        if (!(code > 47 && code < 58) && // numeric (0-9)
            !isAlphaOrSpace(code))
        { // lower alpha (a-z)
            return false;
        }
    }
    return true;
}

function isAlphaNumeric(str)
{
    var code, i;

    for (i = 1; i < str.length; i++)
    {
        code = str.charCodeAt(i);
        if (!(code > 47 && code < 58) && // numeric (0-9)
            !isAlpha(code))
        { // lower alpha (a-z)
            return false;
        }
    }
    return true;
}

function checkIdIsName(id)
{
    if (!isFirstAlpha(document.forms["form1"][id].value))
    {
        errorAt(id + "Error", "first character must be a letter");
        return false;
    }

    if (!isAlphaNumeric(document.forms["form1"][id].value))
    {
        errorAt(id + "Error", "special characters and spaces are not allowed");
        return false;
    }
}

function checkIdIsTitle(id)
{
    if (!isFirstAlpha(document.forms["form1"][id].value))
    {
        errorAt(id + "Error", "first character must be a letter");
        return false;
    }

    if (!isAlphaNumericOrSpace(document.forms["form1"][id].value))
    {
        errorAt(id + "Error", "special characters are not allowed");
        return false;
    }

    errorAt(id + "Error", "");
    return true;
}

function checkIsAlphaNum(id)
{
    if (!isAlphaNumeric(document.forms["form1"][id].value))
    {
        errorAt(id + "Error", "special characters are not allowed");
        return false;
    }

    errorAt(id + "Error", "");
    return true;
}

function isFirstAlpha(str)
{
    return isAlpha(str.charCodeAt(0));
}

function errorAt(id, message)
{
    document.getElementById(id).innerHTML = message;
}