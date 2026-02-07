<?php
  if(!isset($_SESSION['user_id'], $_SESSION['role'])&& $_SESSION['role']==="admin"){
    header("Location: index.php?page=account");
    die();
  }
?>

<main>
  <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>إضافة مشرف جديد</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">إضافة مشرف جديد</span>
      </div>
    </div>
  </div>

<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="admin-add-form col-12 col-md-6">

        <form class="mb-5" method="POST" action="index.php?page=admin-control&action=add">
          <div class="input-group rounded-1 mb-3">
            <input type="text" class="form-control p-3" placeholder="الاسم كامل" aria-label="Username"
              aria-describedby="basic-addon1" name="name"/>
            <span class="input-group-text login__input-icon" id="basic-addon1">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <div class="input-group rounded-1 mb-3">
            <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="Email"
              aria-describedby="basic-addon1" name="email" />
            <span class="input-group-text login__input-icon" id="basic-addon1">
              <i class="fa-solid fa-envelope"></i>
            </span>
          </div>
          <div class="input-group rounded-1 mb-3">
            <input type="password" class="form-control p-3" placeholder="كلمة السر" aria-label="Password"
              aria-describedby="basic-addon1" name="password" />
            <span class="input-group-text login__input-icon" id="basic-addon1">
              <i class="fa-solid fa-key"></i>
            </span>
          </div>

          <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
           إضافة
          </button>
        </form>
      </div>
      <div class="account__forget">
        <p>
          فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني
          الخاص بك. ستتلقى رابطا لإنشاء كلمة مرور جديدة عبر البريد
          الإلكتروني.
        </p>
        <form action="">
          <div class="input-group rounded-1 mb-3">
            <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="Username"
              aria-describedby="basic-addon1" />
            <span class="input-group-text login__input-icon" id="basic-addon1">
              <i class="fa-solid fa-envelope"></i>
            </span>
          </div>
          <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
            اعادة تعيين كلمة المرور
          </button>
        </form>
      </div>
    </div>

</main>