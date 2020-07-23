<form class="custom-from" id="customFrom">

  <h2>Форма обратной связи</h2>

  <span class="custom-from__mess"></span>

  <hr>

  <div class="row">
    <div class="col-lg-6">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group custom-from__group">
            <label for="customFromName">Ваше имя <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control custom-from__group__input" id="customFromName">
          </div>
          <div class="form-group custom-from__group">
            <label for="customFromLastName">Ваше фамилия</label>
            <input type="text" name="lastname" class="form-control custom-from__group__input" id="customFromLastName">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group custom-from__group">
            <label for="customFromPhone">Номер телефона <span class="text-danger">*</span></label>
            <input type="tel" name="phone" class="form-control custom-from__group__input" id="customFromPhone">
          </div>
          <div class="form-group custom-from__group">
            <label for="customFromEmail">E-Mail</label>
            <input type="email" name="email" class="form-control custom-from__group__input" id="customFromEmail">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group custom-from__group">
        <label for="customFromMess">Комментария</label>
        <textarea name="message" id="customFromMess" class="form-control custom-from__group__textarea"></textarea>
      </div>
      <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="form-check">
          <input type="checkbox" name="check" required checked class="form-check-input" id="customFromCheck">
          <label class="form-check-label" for="customFromCheck">Я принимаю {{ the_privacy_policy_link('', '.') }}</label>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
      </div>
    </div>
  </div>
  
</form>