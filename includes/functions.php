<?php
/**
 * Kumpulan fungsi bantu (helper).
 */

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function flash(string $key, ?string $message = null)
{
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }

    if (!empty($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }

    return null;
}

/**
 * Upload gambar project. Mengembalikan nama file baru, atau null jika tidak ada file diupload.
 * Melempar Exception jika upload tidak valid.
 */
function handleImageUpload(array $file, string $targetDir, ?string $oldFile = null): ?string
{
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // tidak ada file baru, biarkan gambar lama
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Terjadi kesalahan saat upload file.');
    }

    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed)) {
        throw new RuntimeException('Format gambar harus jpg, jpeg, png, atau webp.');
    }

    if ($file['size'] > 3 * 1024 * 1024) {
        throw new RuntimeException('Ukuran gambar maksimal 3MB.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($mime !== $allowed[$ext]) {
        throw new RuntimeException('File yang diupload bukan gambar yang valid.');
    }

    $newName = uniqid('proj_', true) . '.' . $ext;
    $destination = rtrim($targetDir, '/') . '/' . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new RuntimeException('Gagal menyimpan file gambar.');
    }

    // hapus gambar lama kalau ada
    if ($oldFile && is_file(rtrim($targetDir, '/') . '/' . $oldFile)) {
        @unlink(rtrim($targetDir, '/') . '/' . $oldFile);
    }

    return $newName;
}
