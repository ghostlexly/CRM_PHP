$(function() {
    autocomplete();
});



function autocomplete() {
    $('.searchbar').typeahead({
        minLength: 3,
        showHintOnFocus: true,
        source: function(q, cb) {
            return $.ajax({
                dataType: 'json',
                type: 'get',
                url: '/search/search-autocomplete.php?q=' + q,
                chache: false,
                success: function(data) {
                    var res = [];
                    $.each(data, function(index, val){
                        if(val !== "%s") {
                            res.push({
                                id: index,
                                name: val
                            })
                        }
                    })
                    cb(res);
                }
            });
        }
    })
}