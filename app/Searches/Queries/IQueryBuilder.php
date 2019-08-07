<?php

namespace App\Searches\Queries;

interface IQueryBuilder
{
    public function getQueryArray();
    
    public function addBoolShouldMatchPhrase($q, $field, $boost=1, $slop=2);

    public function addBoolShouldMatchPhraseAttach($q, $boost=1, $slop=2);
    
    public function addBoolShouldMatchFuzziness($q, $field, $boost=1, $fuzziness="1", $prefix_length=3);

    public function addBoolShouldMatchFuzzinessAttach($q, $boost=1, $fuzziness="1", $prefix_length=3);

    public function addBoolFilterTerm($q, $field);

    public function addBoolMustTerm($q, $field);

    public function addBoolMustGte($q, $field);
}