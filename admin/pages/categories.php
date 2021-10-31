<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách loại hàng</p>
          <a href="add_category.php">
            <button type="button" class="btn btn-primary btn-block">
              <i class="ti-plus mr-4"></i>
              &nbsp;&nbsp;Thêm loại hàng
            </button>
          </a>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-sm-12">
                <table id="orders-table" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending"> Mã loại hàng</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending">Tên loại hàng</th>
                      <th style="width: 100px;">Công cụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="odd">
                      <td>0000001</td>
                      <td>Điện thoại</td>
                      <td>
                        <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                          <i class="ti-pencil-alt mx-0"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon px-0" style="color: white; margin-left: 10px;">
                          <i class="ti-trash mx-0"></i>
                        </button>
                      </td>
                    </tr>
                    <tr class="even">
                      <td>0000002</td>
                      <td>Laptop</td>
                      <td>
                        <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                          <i class="ti-pencil-alt mx-0"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon px-0" style="color: white; margin-left: 10px;">
                          <i class="ti-trash mx-0"></i>
                        </button>
                      </td>
                    </tr>




                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>