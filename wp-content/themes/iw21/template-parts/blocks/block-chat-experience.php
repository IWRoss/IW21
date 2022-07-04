<?php

$slides = [
  [
    "text" => [
      [
        "text" => "Hey IW! We are rolling out a brilliant new simplified Enterprise Contract system to simplify our customer relationships, buying experience and sales process.",
        "side" => "left"
      ],
      [
        "text" => "Lots of our sellers are unsure about this. Some of our customers have bad previous experiences.",
        "side" => "left"
      ],
      [
        "text" => "The content and tools are still in development and we need a great workshop built yesterday to get everyone on board.",
        "side" => "left"
      ],
      [
        "text" => "Can you help?",
        "side" => "left"
      ],
    ],
    "responses" => [
      [
        "text" => "Sure, let’s talk!",
        "action" => "right",
      ],
      [
        "text" => "Sounds hard…",
        "action" => "down",
      ],
    ],
  ],
  [
    "text" => [
      [
        "text" => "Sure, lets talk about it!",
        "side" => "right"
      ],
      [
        "text" => "Multiple teams are working to get a whole set of tools, systems and learning resources up and running on a tight timeline.",
        "side" => "left"
      ],
      [
        "text" => "We are not sure what will be ready when, but can’t afford to wait before getting started.",
        "side" => "left"
      ]
    ],
    "responses" => [
      [
        "text" => "We need to wait",
        "action" => "down",
      ],
      [
        "text" => "Build an MVP",
        "action" => "right",
      ],
    ],
  ],
  [
    "text" => [
      [
        "text" => "No problem, let’s set up an agile process so we can develop some ideas and build out an MVP.",
        "side" => "right"
      ],
      [
        "text" => "Then we can develop our ideas further as your content comes together.",
        "side" => "right"
      ],
      [
        "text" => "Great! Over a few weeks we need to build out a detailed plan of a workshop.",
        "side" => "left"
      ],
      [
        "text" => "The goal is a practical hands on session with the new tools and to get busy sellers really bought in to the value of the new system.",
        "side" => "left"
      ],
      [
        "text" => "Ideally, they should come out of the workshop with new, real opportunities for sales to follow up that will support their goal achievement and win them more bonus!",
        "side" => "left"
      ]
    ],
    "responses" => [
      [
        "text" => "Put responsibility on sellers to make time",
        "action" => "down",
      ],
      [
        "text" => "Make it simple and practical to save time",
        "action" => "right",
      ],
    ],
  ],
];

?>


<div class="block-chat-experience alignfull">
  <div class="reveal block-chat-experience-reveal">
    <div class="slides">
      <?php foreach ($slides as $slide) : ?>
        <section>
          <section>
            <div class="block-chat">
              <div class="block-chat-pane"></div>
              <div class="block-chat-responses">
              </div>
            </div>
          </section>
          <section>Vertical Slide 2</section>
        </section>
      <?php endforeach; ?>
      <section>
        <h1>Done</h1>
      </section>
    </div>

  </div>

</div>

<script>
  const slides = <?php echo json_encode($slides); ?>;
</script>