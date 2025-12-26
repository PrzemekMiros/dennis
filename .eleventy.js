// const filesMinifier = require("@sherby/eleventy-plugin-files-minifier");

module.exports = function (eleventyConfig) {
  // We only render templates we explicitly mark as templates.
  eleventyConfig.setTemplateFormats(["njk", "md", "html"]);

  eleventyConfig.addPassthroughCopy({ "src/assets": "assets" });
  eleventyConfig.addPassthroughCopy({ "src/content/works/img" : "content/works/img" });
  eleventyConfig.addWatchTarget("src/assets/css");
  eleventyConfig.addWatchTarget("src/**/*.html");

  // eleventyConfig.addPlugin(filesMinifier);

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
      data: "data",
    },
  };
};
