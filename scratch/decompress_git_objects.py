import os
import zlib

git_objects_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.git\objects"

found_count = 0

for root, dirs, files in os.walk(git_objects_dir):
    for file in files:
        if len(file) == 38: # Git object filename is 38 chars
            path = os.path.join(root, file)
            try:
                with open(path, "rb") as f:
                    compressed_data = f.read()
                decompressed_data = zlib.decompress(compressed_data)
                
                # Check if it starts with blob
                if decompressed_data.startswith(b"blob"):
                    # Find first null byte which separates header from content
                    null_idx = decompressed_data.find(b"\x00")
                    if null_idx != -1:
                        content = decompressed_data[null_idx+1:]
                        # Try decoding as utf-8
                        try:
                            text = content.decode("utf-8", errors="ignore")
                            if "liveClock" in text and "liveDate" in text and len(text) > 150000:
                                found_count += 1
                                out_path = f"c:\\xampp1\\htdocs\\Sama_College\\scratch\\git_recovered_{found_count}.php"
                                with open(out_path, "w", encoding="utf-8") as out:
                                    out.write(text)
                                print(f"Recovered index.php from git object! Path: {path}, Size: {len(text)}, Saved to: {out_path}")
                        except Exception as e:
                            continue
            except Exception as e:
                continue

print(f"Completed decompressing. Recovered {found_count} candidate files.")
