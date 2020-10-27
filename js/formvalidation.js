$(() => {
  console.log("Validation Loaded");
  $("form[name='signup']").validate({
    rules: {
      email: {
        email: true,
        required: true,
      },
      phone: {
        required: true,
        minlength: 10,
      },
      password: {
        required: true,
        minlength: 8,
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long",
      },
      email: "Please enter a valid email address",
    },
    submitHandler: function (_) {
      var form = $("#signupform")
      .serializeArray()
      .reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
      }, {});

      $.ajax({
        type: "POST",
        data: {
          user: {
            email: form.email,
          },
        },
        datatype: 'text',
        success: function (data) {
          console.log(data);
          if(data.includes("true")){
            $("#userexist").modal("show");
          }else{
            $("#myModal").modal("show");
          }
        },
        
      });
    },
  });
  $("form[name='modalform']").validate({
    rules: {
      phone: {
        required: true,
        minlength: 10,
      },
    },
    messages: {
      phone: {
        required: "Please provide a correct phone number.",
        minlength: "Your phone number must be at least 10 digits long",
      },
    },
    submitHandler: function (form) {
      $("#myModal").modal("hide");
      var formData = $("#signupform, #modalform")
        .serializeArray()
        .reduce(function (obj, item) {
          obj[item.name] = item.value;
          return obj;
        }, {});
      $.ajax({
        type: "POST",
        data: {
          form: {
            name: formData.name,
            email: formData.email,
            passwd: formData.password,
            phone: formData.phone,
            address: formData.address,
            city: formData.city,
            state: formData.state,
            zip: formData.zip,
          },
        },
        datatype: 'text',
        success: function (data) {
          console.log(data);
          if(data == "true"){
            window.location = "../index.php";
          }
        },
      });
    },
  });
});
$("#signupform, #modalform").submit(function (e) {
  e.preventDefault();
});
