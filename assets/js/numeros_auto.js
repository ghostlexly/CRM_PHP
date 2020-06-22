$(function() {


 $("[name='tel_fixe']").keyup(function() {
  var foo = $(this).val().split(" ").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,2}', 'g')).join(" ");
  }
  $(this).val(foo);
  });



  $("[name='tel_portable']").keyup(function() {
  var foo = $(this).val().split(" ").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,2}', 'g')).join(" ");
  }
  $(this).val(foo);
  });

});