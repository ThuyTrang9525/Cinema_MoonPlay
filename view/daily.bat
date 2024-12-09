@echo off
REM Đảm bảo sử dụng đường dẫn đầy đủ
"C:\xampp\php\php.exe" "C:\xampp\htdocs\DoAn\Project_PHP\Cinema_MoonPlay\view\dailyTask.php"

REM Ghi lỗi (nếu có) vào file log để kiểm tra
echo %errorlevel% >> C:\xampp\htdocs\DoAn\Project_PHP\Cinema_MoonPlay\error_log.txt


REM Pause to check for errors or output
pause
