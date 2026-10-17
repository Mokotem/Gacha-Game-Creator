



function Check()
{
    if (checkEstTitle("name"))
    {
        document.getElementById("subid").hidden = true;
        document.getElementById("loadid").hidden = false;
        return true;
    }
    return false;
}

function Cancel()
{
    history.back();
    reload();
}