<?php

$ligne = new Ligneoperationcaisse();
$lignecaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndIdCategorie($boncomm->getId(), 1);
$docs_pdcd = Doctrine_Core::getTable('documentachat')->findOneByIdFils($boncomm->getId());
if ($lignecaisse && $boncomm->ActionSignature() != "") {
    $ligne = $lignecaisse;
    $document_pdcd = new Documentachat();
    if ($docs_pdcd) {
        include_partial('Documents/tddetaildoc', array('boncomm' => $docs_pdcd));
    }
}
if ($boncomm->getIdTypedoc() == 7 && $boncomm->ActionSignature() != "" && $boncomm->getDatesignature()) {
    echo $boncomm->getDatesignature();
}

if ($boncomm->getIdTypedoc() == 18 && $docs_pdcd && $boncomm->ActionSignature() != "") {
    include_partial('Documents/tddetaildoc', array('boncomm' => $docs_pdcd));
    if ($docs_pdcd->getDatesignature())
        echo $docs_pdcd->getDatesignature();
}
?>