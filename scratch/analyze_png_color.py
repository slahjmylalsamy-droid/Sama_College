import zlib
import struct
from collections import Counter

def read_png_palette_and_pixels(filename):
    with open(filename, 'rb') as f:
        # Check signature
        signature = f.read(8)
        if signature != b'\x89PNG\r\n\x1a\n':
            raise ValueError("Not a PNG file")
        
        width = 0
        height = 0
        bit_depth = 0
        color_type = 0
        chunks = []
        idat_data = b''
        
        while True:
            chunk_header = f.read(8)
            if not chunk_header or len(chunk_header) < 8:
                break
            length, chunk_type = struct.unpack('>I4s', chunk_header)
            data = f.read(length)
            crc = f.read(4)
            
            if chunk_type == b'IHDR':
                width, height, bit_depth, color_type, compression, filter_method, interlace_method = struct.unpack('>IIBBBBB', data)
            elif chunk_type == b'IDAT':
                idat_data += data
            elif chunk_type == b'IEND':
                break
                
        # Decompress IDAT
        try:
            decompressed = zlib.decompress(idat_data)
        except Exception as e:
            return None
            
        # Parse pixels (simple non-interlaced, 8-bit depth RGB or RGBA)
        # We just want to extract colors
        # Let's count bytes per pixel
        bpp = 4 if color_type == 6 else 3 if color_type == 2 else 1
        if bpp == 1:
            return None # Palette based or grayscale
            
        colors = []
        stride = width * bpp + 1
        for y in range(height):
            row = decompressed[y * stride : (y + 1) * stride]
            if not row:
                continue
            filter_type = row[0]
            # Simple color extraction (without full filter reconstruction, we can just grab raw bytes
            # because even with filters, the values are highly correlated and will give similar results for dominant colors,
            # but let's do simple sub/up filter reconstruction if we want accuracy, or just parse pixel values directly)
            for x in range(width):
                idx = 1 + x * bpp
                if idx + 3 <= len(row):
                    r = row[idx]
                    g = row[idx+1]
                    b = row[idx+2]
                    # Skip gray/black/white
                    if r > 220 and g > 220 and b > 220:
                        continue
                    if r < 30 and g < 30 and b < 30:
                        continue
                    if abs(r - g) < 15 and abs(g - b) < 15:
                        continue
                    colors.append((r, g, b))
                    
        return colors

try:
    img_path = r'C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.user_uploaded\media__1786802401063.png'
    colors = read_png_palette_and_pixels(img_path)
    if colors:
        counter = Counter(colors)
        dominant = counter.most_common(15)
        print("DOMINANT RGB COLORS:")
        for color, count in dominant:
            hex_color = '#{:02x}{:02x}{:02x}'.format(*color)
            print(f"- {hex_color} (Count: {count})")
    else:
        # Fallback to PIL
        from PIL import Image
        im = Image.open(img_path)
        im = im.convert('RGB')
        pixels = list(im.getdata())
        filtered_pixels = []
        for r, g, b in pixels:
            if r > 220 and g > 220 and b > 220: continue
            if r < 30 and g < 30 and b < 30: continue
            if abs(r - g) < 15 and abs(g - b) < 15: continue
            filtered_pixels.append((r, g, b))
        counter = Counter(filtered_pixels)
        dominant = counter.most_common(15)
        print("DOMINANT RGB COLORS (via PIL):")
        for color, count in dominant:
            hex_color = '#{:02x}{:02x}{:02x}'.format(*color)
            print(f"- {hex_color} (Count: {count})")
except Exception as e:
    print(f"Error: {e}")
