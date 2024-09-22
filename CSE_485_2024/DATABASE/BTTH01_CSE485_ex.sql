--a. Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình (2 đ):--

SELECT * FROM baiviet 
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = 'Nhạc trữ tình';

--b. Liệt kê các bài viết của tác giả "Nhacvietplus" (2 đ):--
SELECT * FROM baiviet 
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = 'Nhacvietplus';

--c. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào (2 đ):--
SELECT * FROM theloai 
WHERE ma_tloai NOT IN (SELECT ma_tloai FROM baiviet);

--d. Liệt kê các bài viết với các thông tin: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết (2 đ):--
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet 
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;

--e. Tìm thể loại có số bài viết nhiều nhất (2 đ):--
SELECT theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet 
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY theloai.ten_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;

--f. Liệt kê 2 tác giả có số bài viết nhiều nhất (2 đ)--
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet 
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
GROUP BY tacgia.ten_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;

--g. Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ "yêu", "thương", "anh", "em" (2 đ):--

SELECT * FROM baiviet 
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' 
OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';

--h. Liệt kê các bài viết về các bài hát có tiêu đề hoặc tựa bài hát chứa 1 trong các từ "yêu", "thương", "anh", "em" (2 đ):--
SELECT * FROM baiviet 
WHERE tieude LIKE '%yêu%' OR tieude LIKE '%thương%' 
OR tieude LIKE '%anh%' OR tieude LIKE '%em%'
OR ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' 
OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';

--i. Tạo view có tên vw_Music hiển thị thông tin về danh sách bài viết kèm theo tên thể loại và tên tác giả (2 đ):--
CREATE VIEW vw_Music AS
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai
FROM baiviet 
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;
--j. Tạo thủ tục sp_DSBaiViet trả về danh sách bài viết của một thể loại (2 đ):--
DELIMITER //
CREATE PROCEDURE sp_DSBaiViet(IN tenTheLoai VARCHAR(50))
BEGIN
   IF EXISTS (SELECT 1 FROM theloai WHERE ten_tloai = tenTheLoai) THEN
      SELECT baiviet.* FROM baiviet 
      INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
      WHERE theloai.ten_tloai = tenTheLoai;
   ELSE
      SELECT 'Thể loại không tồn tại' AS message;
   END IF;
END //
DELIMITER ;

--k. Thêm cột SLBaiViet và tạo trigger cập nhật số lượng bài viết khi thêm/sửa/xóa (2 đ):--
ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;

DELIMITER //
CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT OR UPDATE OR DELETE ON baiviet
FOR EACH ROW 
BEGIN
   IF INSERTING THEN
      UPDATE theloai SET SLBaiViet = SLBaiViet + 1 WHERE ma_tloai = NEW.ma_tloai;
   ELSIF DELETING THEN
      UPDATE theloai SET SLBaiViet = SLBaiViet - 1 WHERE ma_tloai = OLD.ma_tloai;
   END IF;
END //
DELIMITER ;
-- Cấu trúc bảng cho bảng `users`--
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,;


