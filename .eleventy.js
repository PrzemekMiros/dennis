module.exports = function (eleventyConfig) {
  // We only render templates we explicitly mark as templates.
  eleventyConfig.setTemplateFormats(["njk", "md"]);

  // Static assets copied as-is
  eleventyConfig.addPassthroughCopy({ "src/assets": "assets" });
  eleventyConfig.addPassthroughCopy({ "src/media": "media" });

  eleventyConfig.addPassthroughCopy({ "src/content/works/img" : "content/works/img" });

  // Local copies of CDN files from the original ZIP mirror
  eleventyConfig.addPassthroughCopy({ "src/code.jquery.com": "code.jquery.com" });
  eleventyConfig.addPassthroughCopy({ "src/cdnjs.cloudflare.com": "cdnjs.cloudflare.com" });
  eleventyConfig.addPassthroughCopy({ "src/cdn.jsdelivr.net": "cdn.jsdelivr.net" });

  eleventyConfig.addCollection("works", (collectionApi) => {
    return collectionApi
      .getFilteredByGlob("src/content/works/*.md")
      .filter((item) => item.data.home !== false)
      .sort((a, b) => (a.data.order || 0) - (b.data.order || 0));
  });

  eleventyConfig.addCollection("worksAll", (collectionApi) => {
    return collectionApi
      .getFilteredByGlob("src/content/works/*.md")
      .sort((a, b) => (a.data.order || 0) - (b.data.order || 0));
  });

  return {
    dir: {
      input: "src",
      output: "public",
      includes: "includes",
      data: "_data",
    },
  };
};
