<!DOCTYPE html>
<html>
<head>
  <title>主頁</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 新 Bootstrap 核心 CSS 文件 -->
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1>保養品庫存管理系統</h1>
    <p>資料庫系統</p>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <h3>產品</h3>
      <a href="./product/product_search.html">新增、查詢產品資料<br/></a>
      <a href="./product/product_change.html">修改、刪除產品資料</a>
    </div>
    <div class="col-sm-6">
      <h3>進、出貨</h3>
      <a href="./order/order_search.html">新增、查詢進出貨單<br/></a>
      <a href="./order/order_change.html">修改、刪除進出貨單</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <h3>供應商、客戶</h3>
      <a href="./company/company_search.html">新增、查詢買/賣家資料<br/></a>
      <a href="./company/company_change.html">更改、刪除買/賣家資料</a>
    </div>
    <div class="col-sm-6">
      <h3>便捷查詢</h3>
      <a href="./search/search_deadline.html">便捷查詢即期產品<br/></a>
      <a href="./search/search_stock.html">便捷查詢庫存</a>
    </div>
  </div>
</div>

</body>
</html>
