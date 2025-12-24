module.exports = function (eleventyConfig) {
  // We only render templates we explicitly mark as templates.
  eleventyConfig.setTemplateFormats(["njk", "md"]);

  // Static assets copied as-is
  eleventyConfig.addPassthroughCopy({ "src/assets": "assets" });
  eleventyConfig.addPassthroughCopy({ "src/media": "media" });

  // Local copies of CDN files from the original ZIP mirror
  eleventyConfig.addPassthroughCopy({ "src/code.jquery.com": "code.jquery.com" });
  eleventyConfig.addPassthroughCopy({ "src/cdnjs.cloudflare.com": "cdnjs.cloudflare.com" });
  eleventyConfig.addPassthroughCopy({ "src/cdn.jsdelivr.net": "cdn.jsdelivr.net" });

  return {
    dir: {
      input: "src",
      output: "public",
      includes: "includes",
      data: "_data",
    },
  };
};
