function pageScroll(id) {
  $('html, body').animate({
    scrollTop: $(`#${id}`).offset().top - 30
  }, 500);
}
$(document).on("click", ".go_down_btn", function () {
  let id = $(this).closest(".my_content").next(".my_content").attr("id");
  pageScroll(id);
});

$(document).on("click", ".redirect_btn", function () {
  let id = $(this).attr("redirect_to");
  pageScroll(id);
});

function showAlert(title = "", color = "", other = "") {
  $.growl({
    title: title,
    message: other,
    priority: color
  });
}

// search srtart

function get_search_list_html(link = "", head = "", desc = "") {
  let html = `
              <div class="card search_item">
                <a href="${link}" class="card-body d-block search_item_link" >
                  <h5 class="search_item_head">${head}</h5>
                  <small class="search_item_desc">${desc}</small>
                </a>
              </div>
            `;
  return html;
}
function create_search_list() {
  let jsonData = key_words;
  let val = $("#search_input").val();

  let list_div = $("#search_options");
  list_div.html("");
  for (const key in jsonData) {
    if (key.includes(val.toLowerCase())) {
      let r = jsonData[key];
      list_div.append(get_search_list_html(r["url"], r["head"], r["desc"]));
    }
  }
  if (list_div.html() == "") {
    list_div.html(`
              <div class="card search_item">
                <div class="card-body d-block search_item_link" >
                  <h5 class="search_item_head">Data not found!</h5>
                </div>
              </div>
            `);
  }
}
$(document).on("change focus keyup input", "#search_input", function (e) {
  let val = $("#search_input").val();
  let list_div = $("#search_options");
  if (val == "") {
    list_div.html("");
  } else {
    create_search_list()
  }
  if (e.keyCode == "13") {
    let fc = list_div.children(':first');
    if (fc.length == 0 || fc.length == undefined) {
      return;
    } else {
      let link = fc.find(".search_item_link").attr("href");
      window.location.href = link;
      $("#searchModal").modal('toggle');
    }
  }
})
$(document).on("click", "#search_btn", function () {
  let list_div = $("#search_options");
  let fc = list_div.children(':first');
  if (fc.length == 0 || fc.length == undefined) {
    return;
  } else {
    let link = fc.find(".search_item_link").attr("href");
    window.location.href = link;
    $("#searchModal").modal('toggle');
  }
})


$(document).keydown(function (event) {
  // Check if the 'Control' key and 'Q' key are pressed
  if (event.ctrlKey && event.key === 'q') {
    event.preventDefault(); // Prevent the default behavior if needed
    // Add your desired functionality here
    $("#searchModal").modal('toggle');
    $("#searchModal").on('shown.bs.modal', function () {
      $("#search_input").focus();
    });
  }
});

$(document).on("click", ".search_item_link", function () {
  let link = $(this).attr("href");
  window.location.href = link;
  $("#searchModal").modal('toggle');
})




// ///////////

function get_cur_pos(e) {
  if (e.tagName == "INPUT") {
    return e.selectionStart;
  }
}


function set_cur_pos(e, b) {
  if (e.tagName == "INPUT") {
    e.setSelectionRange(b, b);
  }
}


// //////////

function DT(inputDate) {
  const months = [
    "Jan", "Feb", "Mar", "Apr",
    "May", "Jun", "Jul", "Aug",
    "Sep", "Oct", "Nov", "Dec"
  ];

  const date = new Date(inputDate);
  const day = date.getDate();
  const month = months[date.getMonth()];
  const year = date.getFullYear();
  const hours = date.getHours();
  const minutes = date.getMinutes();
  const seconds = date.getSeconds();

  const formattedDate = `${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
  return formattedDate;
}

function TT(unixTimestamp) {
  const months = [
    "Jan", "Feb", "Mar", "Apr",
    "May", "Jun", "Jul", "Aug",
    "Sep", "Oct", "Nov", "Dec"
  ];

  const date = new Date(unixTimestamp * 1000); // Convert seconds to milliseconds

  const day = String(date.getDate()).padStart(2, '0');
  const month = months[date.getMonth()];
  const year = date.getFullYear();
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');

  return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
}

var btn_not = true;

$(document).on('keyup click change', 'input, textarea', function () {
  $(`.reqfield`).remove();
  // $(this).closest('.input-group').next("small").remove();
  if ($(this).val() == "") {
    if ($(this).prev().attr('class') == 'mandetory') {
      // if ($(this).prop('tagName') == 'SELECT' || $(this).prop('tagName') == 'textarea') {
      //   $(this).after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
      // } else
      if ($(this).next().attr("class") == "input-group-append") {
        // $(this).closest('.input-group').after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
      } else {
        $(this).after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
      }
      btn_not = false;

    } else if ($(this).closest('.input-group').prev().attr('class') == 'mandetory') {
      if ($(this).next().attr("class") == "input-group-append") {
        // $(this).closest('.input-group').after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
      } else {
        $(this).after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
      }
      btn_not = false;
    }
  } else {
    $(`.reqfield`).remove();
    // $(this).closest('.input-group').next(`.reqfield`).remove();
    // $(this).next("small").remove();
    // $(this).closest('.input-group').next("small").remove();
  }
});

function redirecT_fiels(id, unit = 4) {
  if ($(id).offset() == undefined) return;
  let ofset = $(id).offset().top
  $("html, body").animate({
    scrollTop:
      ofset -
      $(window).height() / unit,
  });

}


function chekkk() {
  let array1 = [];
  $('.mandetory').each(function (index) {
    let this_attr = $(this).next('input').attr('id');
    if (this_attr === undefined || this_attr === "undefined") {
      if ($(this).next().prop('tagName') == 'SELECT') {
        array1.push('#' + $(this).next('SELECT').attr('id'));
      } else if ($(this).next().prop('tagName') == 'TEXTAREA') {
        array1.push('#' + $(this).next('TEXTAREA').attr('id'));
      } else {
        array1.push('#' + $(this).next('.input-group').find('input').attr('id'));
      }
    } else {
      array1.push('#' + this_attr);
    }

  });

  for (a of array1) {

    $(`.reqfield`).remove();
    if ($(a).val() == "") {

      if ($(a).prev().attr('class') == 'mandetory') {
        redirecT_fiels(a);
        $(a).select();
        $(a).after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
        btn_not = false;

        break;
      } else {
        if ($(a).prop('tagName') == 'SELECT' || $(a).prop('tagName') == 'TEXTAREA') {
          $(a).after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
        } else {

          $(a).closest('.input-group').after(`<small class="text-danger reqfield w-100">This field is required.</small>`);
        }

        redirecT_fiels(a);
        $(a).select();

        btn_not = false;
        break;
      }
    } else {
      $(a).next(`.reqfield`).remove();

    }
  }

  return btn_not;


}

// function save_button(){
$(document).on("click", ".hide_btn_js", function () {



  btn_not = true;

  let email = $(".valemail").val();
  let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  let mobile = $(".valmobile").val();
  let regexm = /^\+?([0-9]{7})\)?[-. ]?([0-9]{3,7})$/;

  let name = $(".onlyAlphabet").val();
  let regexn = /^[A-Za-z-. ]+$/;

  let mainpass = $(".mainpass").val();
  let regexmpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


  if (!chekkk()) return;


  if (name != undefined) {
    if (!regexn.test(name)) {
      $('.fnamealert').html('Please enter a valid name');
      $(".btn_submit").prop("disabled", true);
      redirecT_fiels('#' + $('.onlyAlphabet').attr('id'));
      btn_not = false;

      return;
    } else {
      $(".btn_submit").prop("disabled", false);
      $(".fnamealert").html("");
    }

  }

  if (mobile != undefined) {
    if (!regexm.test(mobile)) {
      $(".mobilealert").html("Please enter a valid mobile");
      $(".btn_submit").prop("disabled", true);
      redirecT_fiels('#' + $('.valmobile').attr('id'));
      btn_not = false;

      return;
    }
    else {
      $(".btn_submit").prop("disabled", false);
      $(".mobilealert").html("");
    }
  }


  if (email != undefined) {
    if (!regex.test(email)) {
      $(".emailalert").html("Please enter a valid email");
      $(".btn_submit").prop("disabled", true);
      redirecT_fiels('#' + $('.valemail').attr('id'));

      return;
    }
    else {
      $(".btn_submit").prop("disabled", false);
      $(".emailalert").html("");
    }
  }


  if (mainpass != undefined) {
    if (!regexmpass.test(mainpass)) {
      $('.mainpass_alert').html("Please enter a valid password");
      $(".btn_submit").prop("disabled", true);
      redirecT_fiels('#' + $('.mainpass').attr('id'));

      return;
    } else {
      $(".btn_submit").prop("disabled", false);
      $(".mainpass_alert").html("");
    }
  }


  var addline_field = $('.addline_1').val();

  if (addline_field == "") {
    $(".btn_submit").prop("disabled", true);
    redirecT_fiels('#' + $('.addline_1').attr('id'));

    return;
  } else if (addline_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.addresss_1_alert').html('');
  }


  let countryval = $("#country").val();
  let entval = $("#pincode").val();
  if (countryval != undefined) {
    $.ajax({
      url: "globdata/country.php",
      type: "POST",
      async: false,
      data: {
        "pincode": entval,
        "country": countryval
      },
      success: function (data) {
        if (data == false) {
          $("#wait").html('<span style="color:maroon">Pincode Not Found <span>');
          $(".load").html('check');
          btn_not = false;
        }
        else {

          data = JSON.parse(data);

          $("#stateselect").val(data['State']);
          $("#discselect").val(data['District']);
          $("#wait").html('<span style="color:green">Getting cities...</span>');
        }
      }
    });
  }




  if (btn_not === true) {
    $('.hide_btn_js').closest('form').submit();
  }


  if (!regex.test(email) || !regexm.test(mobile) || !regexn.test(name) || !regexmpass.test(mainpass) || confirm !== mainpass) {
    $(".btn_submit").prop("disabled", true);
  } else {
    $(".btn_submit").prop("disabled", false);
  }
});






$(document).on("keyup change", "#dep_select", function () {
  var dept_field = $('#dep_select').val();
  if (dept_field == null) {
    $(".btn_submit").prop("disabled", true);
  } if (dept_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.department_alert').html('');
  }
  $(`.reqfield`).remove();
})


$(document).on("keyup change", ".date_of_birth", function () {
  var dt_of_birth_field = $('.date_of_birth').val();
  if (dt_of_birth_field == "") {
    $(".btn_submit").prop("disabled", true);
  } if (dt_of_birth_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.dt_of_b_alert').html('');
  }
  $(`.reqfield`).remove();
})

$(document).on("keyup change", ".date_of_join", function () {
  var dt_of_join_field = $('.date_of_join').val();
  if (dt_of_join_field == "") {
    $(".btn_submit").prop("disabled", true);
  } if (dt_of_join_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.dt_of_join_alert').html('');
  }
  $(`.reqfield`).remove();
});


$(document).on("keyup change", ".gender_select", function () {
  var gender_field = $('.gender_select').val();

  if (gender_field == "") {
    $(".btn_submit").prop("disabled", true);
  } else if (gender_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.genderalert').html('');
  }
  $(`.reqfield`).remove();
});




$(document).on("keyup change", ".salary_field", function () {
  var salary_field = $('.salary_field').val();
  if (salary_field == "") {
    $(".btn_submit").prop("disabled", true);
  } else if (salary_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.salaryalert').html('');
  }
  $(`.reqfield`).remove();
});


$(document).on("keyup change", "#emp_designation", function () {
  var design_field = $('#emp_designation').val();
  if (design_field == null) {
    $(".btn_submit").prop("disabled", true);
  } if (design_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.designation_alert').html('');
  }
  $(`.reqfield`).remove();
});


// /////////


$(document).on("keyup change", ".empty_supCateg_field", function () {

  var categ_field = $('.empty_supCateg_field').val();
  if (categ_field == null) {
    $('.category_alert').html('This field is required.');
    $(".btn_submit").prop("disabled", true);
  }
  if (categ_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.category_alert').html('');
  }
  $(`.reqfield`).remove();
})


$(document).on("keyup change", ".empty_supCompny_field", function () {

  var compny_field = $('.empty_supCompny_field').val();
  if (compny_field == null) {
    $('.company_alert').html('This field is required.');
    $(".btn_submit").prop("disabled", true);
  }
  if (compny_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.company_alert').html('');
  }
  $(`.reqfield`).remove();
})


$(document).on("keyup change", ".empty_supContact_field", function () {
  var contact_field = $('.empty_supContact_field').val();
  if (contact_field == null) {
    $(".btn_submit").prop("disabled", true);
  }
  if (contact_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.contact_alert').html('');
  }
  $(`.reqfield`).remove();
})

$(document).on("keyup change", ".empty_supteleP_field", function () {
  $(`.reqfield`).remove();
  var telep_field = $('.empty_supteleP_field').val();
  if (telep_field == null) {
    $(".btn_submit").prop("disabled", true);
  }
  if (telep_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.telephone_alert').html('');
  }

  $(`.reqfield`).remove();

})

$(document).on("keyup change", ".country", function () {
  var country_field = $('.country').val();
  if (country_field == null) {
    $(".btn_submit").prop("disabled", true);
  }
  if (country_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.country_alert').html('');
  }
  $(`.reqfield`).remove();
})

$(document).on("keyup change", ".pincode", function () {
  var pincode_field = $('.pincode').val();
  if (pincode_field == "") {
    $(".btn_submit").prop("disabled", true);
  }
  if (pincode_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.pincode_alert').html('');
  }
  $('.reqfield').remove();
})

$(document).on("keyup change", ".cityhtml", function () {
  var cityhtml_field = $('.cityhtml').val();
  if (cityhtml_field == null) {
    $(".btn_submit").prop("disabled", true);
  }
  if (cityhtml_field != null) {
    $(".btn_submit").prop("disabled", false);
    $('.city_alert').html('');
  }
  $('.reqfield').remove();
})

$(document).on("keyup change", ".addline_1", function () {
  var addline_field = $('.addline_1').val();
  if (addline_field == "") {
    $(".btn_submit").prop("disabled", true);
  }
  if (addline_field != "") {
    $(".btn_submit").prop("disabled", false);
    $('.addresss_1').html('');
  }
  $(`.reqfield`).remove();
})



// ///



$(document).on("keyup change click", ".valemail", function () {

  $(`.reqfield`).remove();
  let email = $(".valemail").val();
  let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!regex.test(email)) {
    $(".btn_submit").prop("disabled", true);

    $(this).next(".emailalert").html("Invalid Email ID");
  } else {
    $(".btn_submit").prop("disabled", false);
    $(this).next(".emailalert").html("");
  }
});

$(document).on("keyup change click", ".valmobile", function () {
  let mobile = $(".valmobile").val();

  let regex = /^\+?([0-9]{7})\)?[-. ]?([0-9]{3,7})$/;
  if (mobile.length > 15) {
    let remove = mobile.length - 15;
    mobile = mobile.slice(0, -remove);
    $(".valmobile").val(mobile);
  }
  $(`.reqfield`).remove();

  if (!regex.test(mobile)) {
    $(".btn_submit").prop("disabled", true);
    $(this).next(".mobilealert").html("Mobile number must be 10 or 14 digit");
  } else {
    $(".btn_submit").prop("disabled", false);
    $(this).next(".mobilealert").html("");
  }
});






//  //////////// Aadhar card ////////////



input_credit_card = function (jQinp) {
  var format_and_pos = function (input, char, backspace) {
    var start = 0;
    var end = 0;
    var pos = 0;
    var value = input.value;

    if (char !== false) {
      start = input.selectionStart;
      end = input.selectionEnd;

      if (backspace && start > 0) // handle backspace onkeydown
      {
        start--;

        if (value[start] == " ") { start--; }
      }
      // To be able to replace the selection if there is one
      value = value.substring(0, start) + char + value.substring(end);

      pos = start + char.length; // caret position
    }

    var d = 0; // digit count
    var dd = 0; // total
    var gi = 0; // group index
    var newV = "";
    var groups = /^\D*3[47]/.test(value) ? // check for aadhar length 
      [4, 6, 5] : [4, 4, 4];

    for (var i = 0; i < value.length; i++) {
      if (/\D/.test(value[i])) {
        if (start > i) { pos--; }
      }
      else {
        if (d === groups[gi]) {
          newV += " ";
          d = 0;
          gi++;

          if (start >= i) { pos++; }
        }
        newV += value[i];
        d++;
        dd++;
      }
      if (d === groups[gi] && groups.length === gi + 1) // max length of aadhar card 
      { break; }
    }
    input.value = newV;

    if (char !== false) { input.setSelectionRange(pos, pos); }
  };

  jQinp.keypress(function (e) {
    var code = e.charCode || e.keyCode || e.which;

    // Check for tab and arrow keys (needed in Firefox)
    if (code !== 9 && (code < 37 || code > 40) &&
      // and CTRL+C / CTRL+V KeyCode
      !(e.ctrlKey && (code === 99 || code === 118))) {
      e.preventDefault();

      var char = String.fromCharCode(code);

      // if the character is non-digit then
      // -> return false (the character is not inserted in field)

      if (/\D/.test(char)) { return false; }

      format_and_pos(this, char);
    }
  }).
    keydown(function (e) // backspace doesn't fire the Onkeypress event
    {
      if (e.keyCode === 8 || e.keyCode === 46) // backspace KeyCode or delete KeyCode
      {
        e.preventDefault();
        format_and_pos(this, '', this.selectionStart === this.selectionEnd);
      }
    }).
    on('paste', function () {
      // A timeout is needed to get the new value pasted
      setTimeout(function () { format_and_pos(jQinp[0], ''); }, 50);
    }).
    blur(function () // reformat onblur just in case (optional)
    {
      format_and_pos(this, false);
    });
};

//  call the function 

input_credit_card($('.valaadhar'));


$(document).on("keyup keypress change", ".valaadhar", function () {
  let aadhar = $(".valaadhar").val();

  $(`.reqfield`).remove();
  aadhar = $(".valaadhar").val();

  if (aadhar.length == 0) {
    $(".btn_submit").prop("disabled", false);
    $(this).next(".aadharalert").html("");
    check_pan($(".pancard_input"));
  } else if (aadhar.length != 14) {
    $(".btn_submit").prop("disabled", true);
    $(this).next(".aadharalert").html("Please enter a valid aadhar card number");
  }
  else {
    $(".btn_submit").prop("disabled", false);
    $(this).next(".aadharalert").html("");
    check_pan($(".pancard_input"));
  }

})



function check_aadhar(b) {

  // var aadhar_num = /^[0-9]$/;
  let aadhar = $(".valaadhar").val();
  $(`.reqfield`).remove();
  if (aadhar.length == 0) {
    $(".btn_submit").prop("disabled", false);
    $(b).next(".aadharalert").html("");
    check_pan($(".pancard_input"));
  } else if (aadhar.length != 14) {

    $(".btn_submit").prop("disabled", true);
    $(b).next(".aadharalert").html("Please enter a valid aadhar card number");
  } else {
    $(".btn_submit").prop("disabled", false);
    $(b).next(".aadharalert").html("");
    check_pan($(".pancard_input"));
  }
}

// /////////////// Pan card  //////////////


$(document).on("keyup keypress change", ".pancard_input", function () {
  $(`.reqfield`).remove();
  let pan_card = $(".pancard_input").val();

  var check_pan = /^([A-z]){5}([0-9]){4}([A-z])$/;

  if (pan_card == "") {

  } else if (check_pan.test(pan_card)) {
    $(".btn_submit").prop("disabled", false);
    $(".pancard_input").next(".pancardalert").html("");
    check_aadhar($(".valaadhar"))
  } else {
    $(".btn_submit").prop("disabled", true);
    $(".pancard_input").next(".pancardalert").html("Please enter a valid pan card number");
  }
  if (pan_card.length == 0) {
    $(".btn_submit").prop("disabled", false);
    $(".pancard_input").next(".pancardalert").html("");
    check_aadhar($(".valaadhar"))
  }


})



function check_pan(a) {

  $(`.reqfield`).remove();

  let pan_card = $(".pancard_input").val();

  var check_pan = /^([A-z]){5}([0-9]){4}([A-z])$/;

  if (pan_card == "") {

  } else if (check_pan.test(pan_card)) {
    $(".btn_submit").prop("disabled", false);
    $(a).next(".pancardalert").html("");
    check_aadhar($(".valaadhar"));
  } else {
    $(".btn_submit").prop("disabled", true);
    $(a).next(".pancardalert").html("Please enter a valid pan card number");
  }
  if (pan_card.length == 0) {
    $(".btn_submit").prop("disabled", false);
    $(a).next(".pancardalert").html("");
    check_aadhar($(".valaadhar"));
  }

}



$(document).on("keyup change", ".onlyAlphabet", function () {

  $(`.reqfield`).remove();
  var letters = /^[A-Za-z-. ]+$/;
  if ($(this).val().match(letters) || $(this).val() == "" || $(this).val() == undefined) {
    $(".btn_submit").prop("disabled", false);
    $(".btn_submit").attr("disabled", false);
    $(this).next("small").remove();
  } else {
    $(".btn_submit").prop("disabled", true);
    $(".btn_submit").attr("disabled", true);
    $(this).next("small").remove();
    $(this).after(`<small class="text-danger">Name must not include digit or signs</small>`);
  }
})


$(document).on("keyup change click", ".confirmpass , .mainpass", function () {

  let confirm = $(".confirmpass").val();
  let mainpass = $(".mainpass").val();


  let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


  $(`.reqfield`).remove();

  // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special characte

  if (!regex.test(mainpass)) {
    $(".mainpass_alert").html("minimum Alphanumeric:1 , one [@$!%*?&] , min[0-8]char");
    $(".btn_submit").prop("disabled", true);
  } else {
    $(".mainpass_alert").html("");
    $(".btn_submit").prop("disabled", false);
  }

  if (confirm == "" || confirm == undefined) {
    return;
  }

  if (confirm === mainpass) {
    $(".confirm_alert").html("");
    $(".btn_submit").prop("disabled", false);
  } else {
    $(".confirm_alert").html("Password do not match");
    $(".btn_submit").prop("disabled", true);
  }
});


$(".pass_show").click(function () {

  if ($(this).closest("div").prev("input").attr("type") === "password") {
    $(this).closest("div").prev("input").attr("type", "text");
  } else if ($(this).closest("div").prev("input").attr("type") === "text") {
    $(this).closest("div").prev("input").attr("type", "password");
  }
  $(this).find(".mdi").toggleClass("mdi-eye mdi-eye-off");
});


function curencyFormat_bynumber(num) {
  let output = "";
  let mainoutput = "";
  num = num.toString();
  num = num.replaceAll(/[A-Za-z- ]/g, '');
  num = num.replaceAll(/[&\/\\#,_; +()$~%'":=*`?@!|^\[\]<>{}]/g, '');
  if (num == NaN) {
    return "0";
  }
  if (num == "") {
    return "0";
  }
  if (num == "-") {
    return "-";
  }
  if (num == "0") {
    return "0";
  }
  if (num == "." || num == "0.") {
    return "0.";
  }
  if (num == "-." || num == "-0.") {
    return "-0.";
  }
  if (num == "-0") {
    return "-0";
  }
  if (parseInt(num) == NaN) {
    return "0";
  }
  if (parseFloat(num) == "" || parseFloat(num) == " " || parseFloat(num) == NaN) {
    return "0";
  }
  if (parseFloat(num) < 0) {
    num = num.replaceAll("-", "");
    mainoutput = "-";
  }
  num = num.replaceAll(" ", "");
  num = num.replaceAll(",", "");
  num = num.replaceAll("..", "");


  num = num.split(".");

  let after_decimal = "";
  if (num[1] != undefined) {
    if (num[1] == "") {
      after_decimal = ".";
    } else {
      after_decimal = "." + num[1];
    }
  }
  num = num[0].replaceAll(" ", "");
  num = parseInt(num);
  num = num.toString();
  num = convertToArr(num);

  num.reverse().forEach((e, index) => {
    output += e;
    if (index == 2) {
      output += ",";
    } else if (index > 3 && ((index + 1) % 2) == 1) {
      output += ",";
    }
  });
  output = convertToArr(output);
  output.reverse().forEach((e, i) => {
    if (i == 0 && e == ",") {
    } else if (i == 0 && e == "-" && i == 1 && e == ",") {
    } else {
      mainoutput += e;
    }
  });
  let main_length = mainoutput.length;
  for (i = 0; i <= main_length; i++) {
    if (mainoutput[0] == "0") {
      mainoutput = mainoutput.slice(1);
    } else if (mainoutput[0] == ",") {
      mainoutput = mainoutput.slice(1);
    } else {
      break;
    }
  }
  if (after_decimal.length > 3) {
    after_decimal = after_decimal.slice(0, 3);
  }
  if (mainoutput.length == 0 && after_decimal != "") {
    after_decimal = "0" + after_decimal;
  }
  if (mainoutput + after_decimal == NaN) return "0";
  return mainoutput + after_decimal;
}
$(document).on("keyup change keypress", ".curencyFormat", function () {
  curencyFormat(this);
})
function curencyFormat(e) {
  let position = get_cur_pos(e);
  let num = $(e).val();
  let temp_val = num;
  let temp_val_length = temp_val.length;
  let output = "";
  let mainoutput = "";
  if (num == NaN) {
    return "0";
  }
  if (num == "") {
    return "";
  }
  if (num == "-") {
    return "-";
  }
  if (num == "0") {
    return "0";
  }
  if (num == "." || num == "0.") {
    return "0.";
  }
  if (num == "-." || num == "-0.") {
    return "-0.";
  }
  if (num == "-0") {
    return "-0";
  }

  if (parseFloat(num) < 0) {
    num = num.replaceAll("-", "");
    mainoutput = "-";
  }
  num = num.replaceAll(",", "");
  num = num.replaceAll("..", "");
  num = num.replaceAll(/[A-Za-z- ]/g, '');
  num = num.replaceAll(/[&\/\\#,_; +()$~%'":=*`?@!|^\[\]<>{}]/g, '');
  num = num.split(".");
  let after_decimal = "";
  if (num[1] != undefined) {
    if (num[1] == "") {
      after_decimal = ".";
    } else {
      after_decimal = "." + num[1];
    }
  }
  num = num[0];
  num = convertToArr(num);
  num.reverse().forEach((e, index) => {
    output += e;
    if (index == 2) {
      output += ",";
    } else if (index > 3 && (index + 1) % 2 == 1) {
      output += ",";
    }
  });
  convertToArr(output).reverse().forEach((e, i) => {
    if (i == 0 && e == ",") {

    } else if (i == 0 && e == "-" && i == 1 && e == ",") {
    } else {
      mainoutput += e;
    }
  });
  let main_length = mainoutput.length;
  for (i = 0; i <= main_length; i++) {
    if (mainoutput[0] == "0") {
      mainoutput = mainoutput.slice(1);
    } else if (mainoutput[0] == ",") {
      mainoutput = mainoutput.slice(1);
    } else {
      break;
    }
  }
  if (after_decimal.length > 3) {
    after_decimal = after_decimal.slice(0, 3);
  }
  if (mainoutput.length == 0 && after_decimal != "") {
    after_decimal = "0" + after_decimal;
  }
  let final_out = mainoutput + after_decimal;
  let final_length = final_out.length;
  let new_length = final_length - temp_val_length;

  $(e).val(mainoutput + after_decimal)
  position = position + new_length;
  if (parseInt(position) < 0) {
    position = 0;
  }
  set_cur_pos(e, position);
}
function convertToArr(str) {
  let arr = [];
  let k = 0;
  for (let i of str) {
    arr[k++] = i;
  }
  return arr;
}
function Logcat() {
  let a = navigator.geolocation.getCurrentPosition(showPosition);
  function showPosition(position) {
    $("#lat").val(position.coords.latitude);
    $("#long").val(position.coords.longitude);
  }
}



function NTW(num) {
  var ones = ["", "One ", "Two ", "Three ", "Four ", "Five ", "Six ", "Seven ", "Eight ", "Nine ", "Ten ", "Eleven ", "Twelve ", "Thirteen ", "Fourteen ", "Fifteen ", "Sixteen ", "Seventeen ", "Eighteen ", "Nineteen "];
  var tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
  if ((num = num.toString()).length > 9) return "Overflow: Maximum 9 digits supported";
  n = ("000000000" + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
  if (!n) return;
  var str = "";
  str += n[1] != 0 ? (ones[Number(n[1])] || tens[n[1][0]] + " " + ones[n[1][1]]) + "Crore " : "";
  str += n[2] != 0 ? (ones[Number(n[2])] || tens[n[2][0]] + " " + ones[n[2][1]]) + "Lakh " : "";
  str += n[3] != 0 ? (ones[Number(n[3])] || tens[n[3][0]] + " " + ones[n[3][1]]) + "Thousand " : "";
  str += n[4] != 0 ? (ones[Number(n[4])] || tens[n[4][0]] + " " + ones[n[4][1]]) + "Hundred " : "";
  str += n[5] != 0 ? (str != "" ? "and " : "") + (ones[Number(n[5])] || tens[n[5][0]] + " " + ones[n[5][1]]) : "";
  return str;
}

function N_T_W(num) {
  var ones = ["", "One ", "Two ", "Three ", "Four ", "Five ", "Six ", "Seven ", "Eight ", "Nine ", "Ten ", "Eleven ", "Twelve ", "Thirteen ", "Fourteen ", "Fifteen ", "Sixteen ", "Seventeen ", "Eighteen ", "Nineteen "];
  var tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
  if ((num = num.toString()).length > 9) return "Overflow: Maximum 9 digits supported";
  n = ("000000000" + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
  if (!n) return;
  var str = "";
  str += n[1] != 0 ? (ones[Number(n[1])] || tens[n[1][0]] + " " + ones[n[1][1]]) + "Crore " : "";
  str += n[2] != 0 ? (ones[Number(n[2])] || tens[n[2][0]] + " " + ones[n[2][1]]) + "Lakh " : "";
  str += n[3] != 0 ? (ones[Number(n[3])] || tens[n[3][0]] + " " + ones[n[3][1]]) + "Thousand " : "";
  str += n[4] != 0 ? (ones[Number(n[4])] || tens[n[4][0]] + " " + ones[n[4][1]]) + "Hundred " : "";
  str += n[5] != 0 ? (str != "" ? "and " : "") + (ones[Number(n[5])] || tens[n[5][0]] + " " + ones[n[5][1]]) : "";
  return str;
}



function numberToWords(num, m_c_t = "Rupee", s_c_t = "Paise") {
  var fir = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
  var bot = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
  var mid = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

  let output = "";
  let mainoutput = "";
  num = num.toString();
  num = num.replaceAll(",", "");
  if (num == "" || num == "-" || parseInt(num) == 0) return "";
  if (parseInt(num) < 0) {
    num = num.replaceAll("-", "");
    mainoutput = "Minus";
  }

  num = num.replaceAll("..", "");
  num = num.replaceAll(/[A-Za-z- ]/g, '');
  num = num.replaceAll(/[&\/\\#,_; +()$~%'":=*`?@!|^\[\]<>{}]/g, '');
  num = num.split(".");
  let after_decimal = "";
  if (num[1] != undefined) {
    if (num[1] == "") {
      after_decimal = "";
    } else {
      if (num[1].length == 1) {
        num[1] *= 10;
      }
      after_decimal = numberToWords(num[1], m_c_t, s_c_t);
      after_decimal = after_decimal.replace(m_c_t + " Only", s_c_t + " Only");
    }
  }

  num = num[0];
  num = convertToArr(num);
  num = num.reverse();
  num.forEach((e, index) => {
    if (index <= 2) {
      if (index == 2) {
        if (num[index] != 0)
          output += " , " + fir[e] + " Hundred";
      } else if (index == 0) {
        if (num[index + 1] != undefined) {
          if (num[index + 1] == 1) {
            output += " , " + bot[e];
          } else {
            output += " , " + fir[e];
          }
        } else {
          output += " , " + fir[e];
        }
      } else {
        if (num[1] + num[0] == 0) {

        } else {
          if (after_decimal == "") {
            output += " , And " + mid[e];
          } else {
            output += " , " + mid[e];
          }
        }
      }
    } else {
      if (index == 3 && (num[index] + num[index + 1] ?? 0) != 0) output += ", Thousand ,";
      if (index == 5 && (num[index] + num[index + 1] ?? 0) != 0) output += ", Lakh ,";
      if (index == 7 && (num[index] + num[index + 1] ?? 0) != 0) output += ", Crore ,";
      if (index == 9 && (num[index] + num[index + 1] ?? 0) != 0) output += ", Abja ,";
      if ((index) % 2 == 1) {
        if (num[index + 1] != undefined) {
          if (num[index + 1] == 1) {
            output += " , " + bot[e];
          } else {
            output += " , " + fir[e];
          }
        } else {
          output += " , " + fir[e];
        }

      } else if ((index) % 2 == 0) {
        output += " , " + mid[e];
      }
    }
  });
  output = output.split(",");
  output = output.reverse();
  output.forEach((e, i) => {
    mainoutput += e;
  });
  if (mainoutput != "") {
    if (after_decimal != "") {
      mainoutput = mainoutput.replace(/\s+/g, ' ').trim() + " " + m_c_t + " And" + " " + after_decimal.replace(/\s+/g, ' ').trim();
      mainoutput = mainoutput.replace("And And", "And");
    } else {
      mainoutput = mainoutput.replace(/\s+/g, ' ').trim() + " " + m_c_t + " Only";
      mainoutput = mainoutput.replace("And And", "And");
    }
  } else {
    mainoutput = "Zero";
  }
  return mainoutput;
}

function Logcatclass() {
  let a = navigator.geolocation.getCurrentPosition(showPosition);
  function showPosition(position) {
    $(".lat").val(position.coords.latitude);
    $(".long").val(position.coords.longitude);
  }
}



function formatNumberAbbreviation(number) {
  if (number >= 10000000) {
    return (number / 10000000).toFixed(1) + " crore";
  } else if (number >= 100000) {
    return (number / 100000).toFixed(1) + " lakh";
  } else if (number >= 1000) {
    return (number / 1000).toFixed(1) + "k";
  }
  return number.toString();
}

function round(num, places) {
  num = parseFloat(num);
  places = (places ? parseInt(places, 10) : 0)
  if (places > 0) {
    let length = places;
    places = "1";
    for (let i = 0; i < length; i++) {
      places += "0";
      places = parseInt(places, 10);
    }
  } else {

    places = 1;
  }
  return Math.round((num + Number.EPSILON) * (1 * places)) / (1 * places)
}

function mob_print() {
  window.print();
}

if (window.outerWidth < 750) {
  $("[onclick = 'window.print()']").removeClass("d-sm-block");
  $("[onclick = 'window.print()']").hide();
}

function SummerNote(seleter, val) {
  $(seleter).summernote('destroy');
  $(seleter).show();
  $(seleter).val(val);
  $(seleter).summernote();
}

function Max_(arr = []) {
  let max_ = arr[0] ?? 0;
  arr.forEach(el => {
    if (el > max_) {
      max_ = el;
    }
  });
  return max_;
}

function Min_(arr = []) {
  let min_ = arr[0] ?? 0;
  arr.forEach(el => {
    if (el < min_) {
      min_ = el;
    }
  });
  return min_;
}

function sidebar_active() {
  var currentUrl = window.location.pathname;
  urcurrentUrlarr = currentUrl.split("/");
  url = urcurrentUrlarr[urcurrentUrlarr.length - 1];

  ele = $(`a[href=${url}]`);
  if (ele.length == 0) {
    url = active_links[url];
    ele = $(`a[href=${url}]`);
    ele.closest("li").addClass("active");
    ele.closest("li").closest(".menu-sub").closest(".menu-item").addClass("open");
  } else {
    ele.closest("li").addClass("active");
    ele.closest("li").closest(".menu-sub").closest(".menu-item").addClass("open");
  }
}
$(document).ready(function () {
  sidebar_active()
});
jQuery(function ($) {
  $.growl({
    settings: {
      dockId: 'showalert_main',
      displayTimeout: 5000,
    }
  });
})


function copy_text(e, mess = "Text coped succefully") {
  let text = e.attr("data_text");
  navigator.clipboard.writeText(text).then(function () {
    showAlert("Coped", "success", mess);
  }, function (err) {
    showAlert("Error", "danger", "Error in Copy");
  })
}