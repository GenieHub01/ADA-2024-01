/**
 * Created by k on 12.11.16.
 */

$(function () {

    loadCountries(country_id, region_id);

    $('select[name$="[country_id]"]').change(function () {
        loadRegions($('select[name$="[country_id]"]').val(), '');
    });

    $('select[name$="[region_id]"]').change(function () {
        display_sub_region();
    });

    $('#bGeo').click(function () {
        getLocation();
    });

});