from PIL import Image
import os

for f in ['logo.png', 'footer-logo.png', 'images/logo.png']:
    if os.path.exists(f):
        try:
            im = Image.open(f)
            print(f"{f}: size={im.size}, format={im.format}, mode={im.mode}")
        except Exception as e:
            print(f"Error reading {f}: {e}")
