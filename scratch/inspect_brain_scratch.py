import os

scratch_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\scratch"
if os.path.exists(scratch_dir):
    print("Listing files in brain scratch directory:")
    for file in os.listdir(scratch_dir):
        path = os.path.join(scratch_dir, file)
        size = os.path.getsize(path)
        print(f"File: {file}, Size: {size}")
        try:
            with open(path, "r", encoding="utf-8", errors="ignore") as f:
                content = f.read()
            if "index.php" in content:
                print(f"  -> Contains reference to 'index.php'")
        except:
            pass
else:
    print("Brain scratch directory does not exist.")
