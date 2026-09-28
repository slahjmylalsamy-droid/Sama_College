import os
import zlib

git_objects_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.git\objects"

found_count = 0

for root, dirs, files in os.walk(git_objects_dir):
    for file in files:
        if len(file) == 38:
            path = os.path.join(root, file)
            try:
                with open(path, "rb") as f:
                    compressed_data = f.read()
                decompressed_data = zlib.decompress(compressed_data)
                
                if decompressed_data.startswith(b"blob"):
                    null_idx = decompressed_data.find(b"\x00")
                    if null_idx != -1:
                        content = decompressed_data[null_idx+1:]
                        try:
                            text = content.decode("utf-8", errors="ignore")
                            # Relaxed check: contains liveClock and size between 180KB and 350KB
                            if "liveClock" in text and 180000 <= len(text) <= 350000:
                                found_count += 1
                                out_path = f"c:\\xampp1\\htdocs\\Sama_College\\scratch\\git_recovered_v2_{found_count}.php"
                                with open(out_path, "w", encoding="utf-8") as out:
                                    out.write(text)
                                print(f"Recovered index.php candidate! Size: {len(text)}, Saved to: {out_path}")
                        except Exception as e:
                            continue
            except Exception as e:
                continue

print(f"Decompress v2 completed. Found {found_count} candidate files.")
