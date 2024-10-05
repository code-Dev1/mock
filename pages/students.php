<?php
$std = new Student();
$result = $std->studnets();

?>
<h3>لیست شاگردان</h3>
<hr>
<div>
  <form action="">
    <div class="input-group ltr mb-4">
      <input type="text" class="form-control rtl">
      <input type="submit" value="جستوجو" class="btn btn-success">
    </div>
  </form>
  <table class="table table-responsive ms-2">
    <thead>
      <tr>
        <th># شماره</th>
        <th>نام کامل</th>
        <th>ایمیل</th>
        <th>دیپارتمینت</th>
        <th class="<?= ($role) ? '' : 'd-none' ?>">حمل</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row): ?>
        <tr>
          <td>
            <?= $row->studentId ?>
          </td>
          <td>
            <?= $row->firstName . " " . $row->lastName ?>
          </td>
          <td>
            <?= $row->email ?>
          </td>
          <td>
            <?= $row->department ?>
          </td>
          <td>
            <button class="btn btn-success <?= ($role) ? '' : 'd-none' ?>"><a
                href="dashboard?page=stdUp&stdId=<?= $row->studentId ?>" class="text-light text-decoration-none">
                بروزرسانی </a><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger <?= ($role) ? '' : 'd-none' ?>"><a
                href="dashboard?page=stdDel&stdId=<?= $row->studentId ?>" class="text-light text-decoration-none"> حذف
              </a><i class="fa fa-trash"></i></button>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<div class="d-flex justify-content-center w-100">
  <nav aria-label="...">
    <ul class="pagination">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active" aria-current="page">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>