<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefFunctionEncodeuri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        DB::select("
        CREATE OR REPLACE FUNCTION urlencode(in_str text, OUT _result text)
            STRICT IMMUTABLE AS \$urlencode\$
        DECLARE
            _i      int4;
            _temp   varchar;
            _ascii  int4;
        BEGIN
            _result = '';
            FOR _i IN 1 .. length(in_str) LOOP
                _temp := substr(in_str, _i, 1);
                IF _temp ~ '[0-9a-zA-Z:/@._?#-]+' THEN
                    _result := _result || _temp;
                ELSE
                    _ascii := ascii(_temp);
                    IF _ascii > x'07ff'::int4 THEN
                        RAISE EXCEPTION 'Won''t deal with 3 (or more) byte sequences.';
                    END IF;
                    IF _ascii <= x'07f'::int4 THEN
                        _temp := '%'||to_hex(_ascii);
                    ELSE
                        _temp := '%'||to_hex((_ascii & x'03f'::int4)+x'80'::int4);
                        _ascii := _ascii >> 6;
                        _temp := '%'||to_hex((_ascii & x'01f'::int4)+x'c0'::int4)
                                    ||_temp;
                    END IF;
                    _result := _result || upper(_temp);
                END IF;
            END LOOP;
            RETURN ;
        END;
        ");

        DB::select("\$urlencode\$ LANGUAGE plpgsql;");

        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
