

function CheckGacha()
{
    if (!checkEstTitle("title"))
    {
        return false;
    }

    let t = document.forms["form1"]["title"].value;
    if ($names.includes(t))
    {
        errorAt("titre", "you already have a gacha with name '" + t + "'");
        return false;
    }

    releaseError("titre");
    return true;
}