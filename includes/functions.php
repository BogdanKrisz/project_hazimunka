<?php

function szemelyek_to_select()
{
    $szemelyek = Szemely::szemely_mind();

    foreach($szemelyek as $szemely)
    {
        echo "<option>" . $szemely->nev . "</option>";
    }
}

?>