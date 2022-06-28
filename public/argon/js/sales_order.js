
var a = 1;
var nextid_b = 2;
var nextid_s = 2;
// var curr = (data.currency);
$("#addkolom_b").click(function () {
     addkolom_b();
     console.log(curr);
});
function addkolom_b() {
     var kolom = '<tr>' +
          '<td><input class="autosuggest ui-widget" type="text" id="description_b' + nextid_b + '" name="description_b[]"></td>' +
          '<td><input class="qty" type="text" id="qty_b' + nextid_b + '" name="qty_b[]"></td>' +
          // '<td><input type="text" id="curr_b' + nextid_b + '" name="curr_b[]"></td>' +
          '<td><select id="curr_b' + nextid_b + '" name="curr_b[]" class="form-select" aria-label="Default select example">' +
          '<option selected>Open this select menu</option>' +
          '<option>IDR</option>' +
          '<option>SGD</option>' +
          '<option>USD</option>' +
          '<option>EUR</option>' +
          '</select></td>' +
          '<td><input class="price" type="text" id="price_b ' + nextid_b + '" name="price_b[]"></td>' +
          '<td><input class="sub_total" type="text" id="sub_total_b ' + nextid_b + '" name="sub_total_b[]"></td>' +
          '<td><input class="remark_b ui-widget" type="text" id="remark_b ' + nextid_b + '" name="remark_b[]"></td>' +
          '<td><input class="name_b" type="text" id="name_b ' + nextid_b + '" name="name_b[]"></td>' +
          '<td></td>' +
          '<td><a href="#" id="removekolom_b" class="btn btn-danger remove_b"><i class="fa fa-times"></i></a></td>' +
          '</tr>';
     $('.buying').append(kolom);
     nextid_b++;
};
$(document).on('click', '.remove_b', function () {
     var l = $('tbody.buying tr').length;
     // console.log(l);
     if (l == 1) {
          alert('tidak dapat menghapus lagi');
     } else {
          $(this).parent().parent().remove();
     }
});
$("#addkolom_s").click(function () {
     addkolom_s();
     // console.log(sub);
});
function addkolom_s() {
     var kolom = '<tr>' +
          '<td><input class="autosuggest ui-widget" type="text" id="description_s' + nextid_s + '" name="description_s[]"></td>' +
          '<td><input class="qty" type="text" id="qty_s' + nextid_s + '" name="qty_s[]"></td>' +
          // '<td><input type="text" id="curr_s' + nextid_s + '" name="curr_s[]"></td>' +
          '<td><select id="curr_s' + nextid_s + '" name="curr_s[]" class="form-select" aria-label="Default select example">' +
          '<option selected>Open this select menu</option>' +
          '<option>IDR</option>' +
          '<option>SGD</option>' +
          '<option>USD</option>' +
          '<option>EUR</option>' +
          '</select></td>' +
          '<td><input class="price" type="text" id="price_s ' + nextid_s + '" name="price_s[]"></td>' +
          '<td><input class="sub_total" type="text" id="sub_total_s ' + nextid_s + '" name="sub_total_s[]"></td>' +
          '<td><input type="text" id="remark_s ' + nextid_s + '" name="remark_s[]"></td>' +
          '<td><input type="text" id="name_s ' + nextid_s + '" name="name_s[]"></td>' +
          '<td></td>' +
          '<td><a href="#" id="removekolom_s" class="btn btn-danger remove_s"><i class="fa fa-times"></i></a></td>' +
          '</tr>';
     $('.selling').append(kolom);
     nextid_s++;
};
$(document).on('click', '.remove_s', function () {
     var l = $('tbody.selling tr').length;
     // console.log(l);
     if (l == 1) {
          alert('tidak dapat menghapus lagi');
     } else {
          $(this).parent().parent().remove();
     }
});