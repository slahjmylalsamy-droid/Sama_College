import os

log_path = "c:\\xampp1\\apache\\logs\\error.log"
if os.path.exists(log_path):
    print("Last 30 lines of Apache error log:")
    with open(log_path, "r", encoding="utf-8", errors="ignore") as f:
        lines = f.readlines()
        for line in lines[-30:]:
            print(line.strip())
else:
    print("Apache error log not found.")
