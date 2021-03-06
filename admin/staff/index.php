<?php require '../check_admin.php' ?>
<?php require '../header_admin.php' ?>			
			<div class="details">
				<div class="recentOrder">
					<div class="table_header">
						<?php
							require '../db/connect.php';
							$category_search = 'id';
							$search = '';
							if (isset($_GET['search']) && isset($_GET['category_search']) ) {
								$search = $_GET['search'];
								$category_search = $_GET['category_search'];
								$sql_number_of_rows = "select count(*)
								from staff where $category_search like '%$search%' ";
							}else {
								$sql_number_of_rows = "select count(*)
								from staff ";
								
							}
							require '../pagination/pagination_process.php';	

							if (isset($_GET['search']) && isset($_GET['category_search']) ) {
								$search = $_GET['search'];
								$category_search = $_GET['category_search'];
								$sql = "select * from staff where $category_search like '%$search%' limit $number_of_rows_on_pages offset $offset ";
							}else {
								$sql = "select * from staff limit $number_of_rows_on_pages offset $offset";
							}
							$result = mysqli_query($connect,$sql); 
						?>
						<h1>Danh sách nhân viên</h1>
						<?php require '../notification.php' ?>
						<a href="form_insert.php">
							<b>
								Thêm nhân viên
							</b>
						</a>
					</div>
					<form>
						<div style="display: flex;">
							<div style="margin-left: 150px;">
								<label style="padding-right: 10px;">
									<b>Tìm kiếm</b>
								</label>
								<input type="text" name="search" value="<?php echo $search ?>">
							</div>
							<div style="margin-left: 50px;  margin-right: 40px;">
								<label style="padding-right: 10px;">
									<b>Danh mục tìm kiếm</b>
								</label>
								<select name="category_search">
									<?php 
										switch ($category_search) {
											case '': ?>
												<option value="id">Mã</option>
												<option value="name">Tên nhân viên</option>
												<option value="address">Địa chỉ</option>
												<option value="gender">giới tính</option>
											<?php  
											break;

											case 'id': ?>
												<option selected value="id">Mã</option>
												<option value="name">Tên nhân viên</option>
												<option value="address">Địa chỉ</option>
												<option value="gender">giới tính</option>
											<?php  
											break;
											case 'name': ?>
												<option value="id">Mã</option>
												<option selected value="name">Tên nhân viên</option>
												<option value="address">Địa chỉ</option>
												<option value="gender">giới tính</option>
											<?php  
											break;
											case 'address': ?>
												<option value="id">Mã</option>
												<option value="name">Tên nhân viên</option>
												<option selected value="address">Địa chỉ</option>
												<option value="gender">giới tính</option>
											<?php  
											break;
											case 'gender': ?>
												<option value="id">Mã</option>
												<option value="name">Tên nhân viên</option>
												<option value="address">Địa chỉ</option>
												<option selected value="gender">giới tính</option>
											<?php
											break;
										}
									?>
								</select>
							</div>
							<button type="submit">
								tìm kiếm
							</button>
						</div>
					</form>
					<br>
					<table class="table_values" width="100%" border="1">
						<tr>
							<th>Mã</th>
							<th>Tên nhân viên</th>
							<th>Số điện thoại</th>
							<th>Địa chỉ</th>
							<th>Giới tính</th>
							<th>ngày sinh</th>
							<th>Email</th>
							<th>Password</th>
							<th>Level</th>
							<th>Sửa</th>
							<th>Xoá</th>
						</tr>
						<?php foreach ($result as $each): ?>
							<tr class="table_tr">
								<td><?php echo $each['id'] ?></td>
								<td><?php echo $each['name'] ?></td>
								<td><?php echo $each['phone_number'] ?></td>
								<td><?php echo $each['address'] ?></td>
								<td><?php echo $each['gender'] ?></td>
								<td><?php echo $each['date'] ?></td>
								<td><?php echo $each['email'] ?></td>
								<td><?php echo $each['password'] ?></td>
								<td>
									<?php
										if($each['level'] == 1) {
											echo 'admin';
										}elseif($each['level'] == 0) {
											echo 'Nhân viên';
										}
									?>
								</td>
								<td>
									<a class="table_update" href="form_update.php?id=<?php echo $each['id'] ?>">Sửa</a>
								</td>
								<td>
									<a class="table_update" onclick="return confirm('bạn chắc chắn xoá nhân viên này chứ ?')" href="delete.php?id=<?php echo $each['id'] ?>">Xoá</a>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
					<?php require '../pagination/pagination_display.php' ?>
				</div>
			</div>
			<?php require '../footer.php' ?>