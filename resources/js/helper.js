export function strSlug(str) {
    return str
        .replace(/&&+/g, "&")
        .replace(/&+/g, "and")
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/--+/g, "-")
        .toLowerCase()
        .trim();
}
