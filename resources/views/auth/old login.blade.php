

<section class="login py-5">
    <div class="container" style="min-height: 70vh;">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-6">
        <div class="form-box">
        <h3 class="text-center">تسجيل دخول</h3>
        <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mobile" class="form-label"> الموبايل <em> * </em> </label>
            <input class="form-control" required="" type="text" placeholder="البريد الالكتروني" name="email" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
        </div>
        <div class="form-group">
            <label for="password" class="form-label"> كلمة المرور <em> * </em> </label>
            <input class="form-control" required="" type="password" placeholder="كلمة المرور" name="password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
          </div>
          <div class="form-group">
              <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="rememberMe">
                <label class="custom-control-label" for="rememberMe">تذكرني</label>
              </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
              <button class="btn btn-primary my_btn  log-btn">تسجيل دخول</button>
              <a href="" class="">هل نسيت كلمة السر؟</a>
          </div>
      </form>
      <div class="register-acc text-center mt-3">
                  <a href="/register"> إنشاء حساب جديد </a>
               </div>
        </div>
      </div>
    </div>
    </div>
  </section>
